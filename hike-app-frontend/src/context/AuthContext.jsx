/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useEffect, useState } from "react";
import * as tokenService from "../services/tokenService";
import {
  loginApi,
  logoutApi,
  fetchUserApi,
  refreshApi,
  signupApi,
} from "../services/apiAuth";

export const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [isLoading, setIsLoading] = useState(true);
  const [token, setToken] = useState(() => tokenService.getToken());
  // do I really need this tho??
  const [tokenExpiry, setTokenExpiry] = useState(() =>
    tokenService.getTokenExpiry(),
  );
  const [user, setUser] = useState(null);
  const [refreshTimer, setRefreshTimer] = useState(null);

  async function login({ email, password }) {
    const { access_token: newToken, expires_in } = await loginApi({
      email,
      password,
    });

    setToken(newToken);
    tokenService.setToken(newToken);
    const tokenExpiry = calculateTokenExpiry(expires_in);
    setTokenExpiry(tokenExpiry);
    tokenService.setTokenExpiry(tokenExpiry);
    // schedule refresh?! or just use the timer directly?!
    await loadUserFromToken();
  }

  function calculateTokenExpiry(expiresIn, currentTimeInMs = Date.now()) {
    return currentTimeInMs + expiresIn * 1000;
  }

  async function loadUserFromToken() {
    if (!tokenService.hasToken()) return;

    // NOT SRP - try catch is one thing...
    try {
      const { user } = await fetchUserApi();
      setUser(user);
    } catch (error) {
      console.warn("Failed to load user:", error);
      logout();
    }
  }

  function signup({ firstName, lastName, email, password, passwordConfirm }) {
    return signupApi({ firstName, lastName, email, password, passwordConfirm });
  }

  async function logout() {
    setUser(null);
    setToken(null);
    setTokenExpiry(null);
    setRefreshTimer(null);
    await logoutApi();
    tokenService.removeTokenAndTokenExpiry();
  }

  // todo handle refresh

  useEffect(function () {
    async function initSession() {
      if (!token) {
        setIsLoading(false);
        return; // is this necessary when it is checked in loadUser?!?! mayb yes, but only for sched refresh sake?!?
      }
      await loadUserFromToken();

      // scheduleRefresh();
      setIsLoading(false);
    }
    initSession(); // fix naming
  }, []);

  return (
    <AuthContext.Provider
      value={{
        user,
        login,
        signup,
        logout,
        isLoading, // todo make this a hook? also do I use/need this?
        isAuthenticated: user !== null, // todo make this a hook? the rest all have a hook each
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  return useContext(AuthContext);
}
