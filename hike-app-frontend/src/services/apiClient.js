import axios from "axios";
import { API_BASE_URL } from "../config";
import {
  getToken,
  isTokenSet,
  removeTokenAndTokenExpiry,
} from "./tokenService";
import toast from "react-hot-toast";

export const apiClient = axios.create({
  baseURL: API_BASE_URL,
});

apiClient.interceptors.request.use((config) => {
  if (isTokenSet()) {
    config.headers.Authorization = `Bearer ${getToken()}`;
  }
  return config;
});

apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    const message = error.response?.data?.message || error.message;
    toast.error(message);

    if (error?.response?.status === 401) {
      removeTokenAndTokenExpiry(); //quick fix - but then, there shouldn't be a token if this happens...

      window.location.href = "/auth/login";
      // this is why I will use Redux in my next project...
    }

    // todo add handling for 403

    // todo add handling for 404 -> Redirect to a not found page?

    return Promise.reject(error);
  },
);
