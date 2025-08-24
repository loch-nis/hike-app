/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useEffect, useRef, useState } from "react";
import {
  setToken,
  getToken,
  removeToken,
  setTokenExpiry,
  getTokenExpiry,
  removeTokenExpiry,
  removeTokenAndTokenExpiry,
  isTokenSet,
  isTokenExpired,
  calculateTokenRefreshDelay,
} from "../services/tokenService";
import {
  loginApi,
  logoutApi,
  fetchUserApi,
  refreshApi,
  signupApi,
} from "../services/apiAuth";

export const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [isAuthReady, setIsAuthReady] = useState(false);
  const [user, setUser] = useState(null);
  const refreshTimerRef = useRef(null);

  useEffect(function () {
    resumeSession(); // self-quiz: Why should this be in an effect?

    return clearScheduledRefresh; // self-quiz: what kind of function is this? And when does it run?
  }, []);

  async function resumeSession() {
    if (!isTokenSet()) {
      setIsAuthReady(true);
      return;
    }

    if (isTokenExpired()) {
      logout();
      setIsAuthReady(true);
      return;
    }

    scheduleTokenRefresh();
    await resolveUserFromToken();
    setIsAuthReady(true);
  }

  async function login({ email, password }) {
    const { access_token: newToken, expires_in: expiresIn } = await loginApi({
      email,
      password,
    });

    setToken(newToken);
    setTokenExpiry(expiresIn);
    scheduleTokenRefresh();
    await resolveUserFromToken();
  }

  async function resolveUserFromToken() {
    if (!isTokenSet()) return;

    const { user } = await fetchUserApi();
    setUser(user);
  }

  function signup({ firstName, lastName, email, password, passwordConfirm }) {
    return signupApi({ firstName, lastName, email, password, passwordConfirm });
  }

  async function logout() {
    setUser(null);
    clearScheduledRefresh();
    await logoutApi();
    removeTokenAndTokenExpiry();
  }

  function scheduleTokenRefresh() {
    if (refreshTimerRef.current) clearTimeout(refreshTimerRef.current);

    const refreshDelay = calculateTokenRefreshDelay();

    refreshTimerRef.current = setTimeout(async () => {
      const { access_token: newToken, expires_in: expiresIn } =
        await refreshApi();

      setToken(newToken);
      setTokenExpiry(expiresIn);

      scheduleTokenRefresh();
    }, refreshDelay);
  }

  function clearScheduledRefresh() {
    if (refreshTimerRef.current) {
      clearTimeout(refreshTimerRef.current);
      refreshTimerRef.current = null;
    }
  }

  return (
    <AuthContext.Provider
      value={{
        user,
        login,
        signup,
        logout,
        isAuthReady,
        isAuthenticated: user !== null,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  return useContext(AuthContext);
}
