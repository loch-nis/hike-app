import apiClient from "./apiClient";
import authClient from "./authClient";

export async function loginApi({ email, password }) {
  // axios will throw error automatically
  // and the whole async function will return a rejected Promise
  const response = await authClient.post("/auth/login", {
    email,
    password,
  });
  return response.data;
}

export async function signupApi({ firstName, lastName, email, password }) {
  const response = await authClient.post("/auth/register", {
    first_name: firstName,
    last_name: lastName,
    email,
    password,
  });
  return response.data;
}

export async function logoutApi() {
  const response = await apiClient.post("/auth/logout");
  return response.data;
}
export async function fetchUserApi() {
  const response = await apiClient.get("/auth/me");
  return response.data;
}
export async function refreshApi() {
  const response = await apiClient.post("/auth/refresh");
  return response.data;
}
