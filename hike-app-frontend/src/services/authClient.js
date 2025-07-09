import axios from "axios";
import { API_BASE_URL } from "../config";

const authClient = axios.create({
  baseURL: API_BASE_URL,
  /* headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  }, */ //todo this should be default with axious, unlike fetch
});

export default authClient;
