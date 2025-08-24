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

export function setTokenExpiry(expiresIn, currentTimeInMs = Date.now()) {
  const expiry = currentTimeInMs + expiresIn * 1000;
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

export function isTokenSet() {
  return getToken() !== null;
}

// todo good cases for a unit tests:
export function isTokenExpired() {
  const expiry = getTokenExpiry();
  return expiry ? Date.now() > expiry : true;
}

export function calculateTokenRefreshDelay() {
  const oneMinuteBuffer = 60_000;
  return getTokenExpiry() - Date.now() - oneMinuteBuffer;
}
