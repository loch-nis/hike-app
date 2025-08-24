import { apiClient } from "./apiClient";
import { authClient } from "./authClient";
import camelcaseKeys from "camelcase-keys";

export async function loginApi({ email, password }) {
  // axios will throw error automatically
  // and the whole async function will return a rejected Promise
  const response = await authClient.post("/auth/login", {
    email,
    password,
  });
  return response.data;
}

export async function signupApi({
  firstName,
  lastName,
  email,
  password,
  passwordConfirm,
}) {
  const response = await authClient.post("/auth/register", {
    first_name: firstName,
    last_name: lastName,
    email,
    password,
    password_confirmation: passwordConfirm,
  });
  // todo use camelcase Keys instead - but the opposite way. Snake case?

  return response.data;
}

export async function logoutApi() {
  const response = await apiClient.post("/auth/logout");
  return response.data;
}
export async function fetchUserApi() {
  const response = await apiClient.get("/auth/me");
  const user = camelcaseKeys(response.data, { deep: true });
  return { user }; // todo this is the only place where it returns an obj. Fix inconsistency
}
export async function refreshApi() {
  const response = await apiClient.post("/auth/refresh");
  return response.data;
}
