import axios from "axios";
import { API_BASE_URL } from "../config";
import { getToken, hasToken, removeTokenAndTokenExpiry } from "./tokenService";
import toast from "react-hot-toast";

const apiClient = axios.create({
  baseURL: API_BASE_URL,
});

apiClient.interceptors.request.use((config) => {
  if (hasToken()) {
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
      removeTokenAndTokenExpiry(); //quick fix - but then, there shoudlnt be a token if this happens...

      window.location.href = "/auth/login";
    }

    return Promise.reject(error);
  },
);

export default apiClient;
