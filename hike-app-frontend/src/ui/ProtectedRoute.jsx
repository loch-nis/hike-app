import { FullPage } from "./FullPage";
import { Spinner } from "./Spinner";
import { Navigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

export function ProtectedRoute({ children }) {
  const { isAuthReady, isAuthenticated } = useAuth();

  if (!isAuthReady) {
    return (
      <FullPage>
        <Spinner />
      </FullPage>
    );
  }

  if (!isAuthenticated) return <Navigate to={"/auth/login"} replace />;

  if (isAuthenticated) return children;
}
