/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useEffect, useRef, useState } from "react";
import {
  setToken,
  getToken,
  setTokenExpiry,
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

  // todo naming here isn't ideal, should refactor at some point - name clash with setToken()
  const [authToken, setAuthToken] = useState(getToken());

  useEffect(function () {
    resumeSession(); // reminder-quiz: Why should this be in an effect?

    return clearScheduledRefresh;

    // eslint-disable-next-line react-hooks/exhaustive-deps
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

    setAuthToken(getToken());
    scheduleTokenRefresh();
    await resolveUserFromToken();
    setIsAuthReady(true);
  }

  async function login({ email, password }) {
    const { access_token: newToken, expires_in: expiresIn } = await loginApi({
      email,
      password,
    });

    setAuthToken(newToken);
    setToken(newToken);
    setTokenExpiry(expiresIn);
    scheduleTokenRefresh();
    await resolveUserFromToken();
  }

  async function resolveUserFromToken() {
    if (!isTokenSet()) return;

    const user = await fetchUserApi();
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
    setAuthToken(null);
  }

  function scheduleTokenRefresh() {
    if (refreshTimerRef.current) clearTimeout(refreshTimerRef.current);

    const refreshDelay = calculateTokenRefreshDelay();

    refreshTimerRef.current = setTimeout(async () => {
      const { access_token: newToken, expires_in: expiresIn } =
        await refreshApi();

      setAuthToken(newToken);
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
        token: authToken,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  return useContext(AuthContext);
}
