const TOKEN_KEY = "token";
const TOKEN_EXPIRY_KEY = "token_expiry";

export function setToken(token) {
  localStorage.setItem(TOKEN_KEY, token);
}

export function getToken() {
  return localStorage.getItem(TOKEN_KEY);
}

export function removeToken() {
  localStorage.removeItem(TOKEN_KEY);
}

export function setTokenExpiry(expiry) {
  localStorage.setItem(TOKEN_EXPIRY_KEY, expiry.toString());
}

export function getTokenExpiry() {
  const expiry = localStorage.getItem(TOKEN_EXPIRY_KEY);
  return expiry ? +expiry : null;
}

export function removeTokenExpiry() {
  localStorage.removeItem(TOKEN_EXPIRY_KEY);
}

export function removeTokenAndTokenExpiry() {
  removeToken();
  removeTokenExpiry();
}

export function hasToken() {
  return getToken() !== null;
}

export function isTokenExpired() {
  const expiry = getTokenExpiry();
  return expiry ? Date.now() > expiry : true;
  // todo not sure if working!
}
