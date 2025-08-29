import { configureEcho } from "@laravel/echo-react";
import { useAuth } from "./AuthContext";
import { useEffect } from "react";

export function EchoManager() {
  const { token } = useAuth();

  useEffect(() => {
    if (!token) {
      window.Echo?.disconnect?.();
      return;
    }

    configureEcho({
      broadcaster: "reverb",
      key: import.meta.env.VITE_REVERB_APP_KEY,
      wsHost: import.meta.env.VITE_REVERB_HOST,
      wsPort: import.meta.env.VITE_REVERB_PORT,
      wssPort: import.meta.env.VITE_REVERB_PORT,
      forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
      enabledTransports: ["ws", "wss"],
      authEndpoint:
        import.meta.env.VITE_API_URL.replace(/\/api$/, "") +
        "/broadcasting/auth",
      auth: {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      },
    });

    console.log(window.Echo);

    return () => {
      window.Echo?.disconnect?.();
    };
  }, [token]);

  return null;
}
