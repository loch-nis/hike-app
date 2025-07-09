import { BrowserRouter, Route, Routes } from "react-router-dom";
import HikeDetails from "./pages/HikeDetails";
import Hikes from "./pages/Hikes";
import PageNotFound from "./pages/PageNotFound";
import Login from "./pages/Login";
import AuthLayout from "./ui/AuthLayout";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Toaster } from "react-hot-toast";
import Signup from "./pages/Signup";
import AuthProvider from "./context/AuthContext";
import ProtectedRoute from "./ui/ProtectedRoute";
import AppLayout from "./ui/AppLayout";
import CreateHike from "./pages/CreateHike";

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      // staleTime: 60 * 1000,
      staleTime: 0,
    },
  },
});

export default function App() {
  return (
    <AuthProvider>
      <QueryClientProvider client={queryClient}>
        <BrowserRouter>
          <Routes>
            <Route path="auth" element={<AuthLayout />}>
              <Route path="login" element={<Login />} />
              <Route path="register" element={<Signup />} />
            </Route>
            <Route
              element={
                <ProtectedRoute>
                  <AppLayout />
                </ProtectedRoute>
              }
            >
              <Route path="hikes" element={<Hikes />} />
              <Route path="hikes/new" element={<CreateHike />} />
              <Route path="hikes/:hikeId" element={<HikeDetails />} />
            </Route>
            <Route path="*" element={<PageNotFound />} />
          </Routes>
        </BrowserRouter>
        <Toaster
          position="top-center"
          gutter={12}
          containerStyle={{ margin: "8px" }}
          toastOptions={{
            success: {
              duration: 3000,
            },
            error: {
              duration: 5000,
            },
            style: {
              fontSize: "16px",
              maxWidth: "500px",
              padding: "16px 24px",
              backgroundColor: "white", //var(--color-grey-0)
              color: "var(--color-grey-700)",
            },
          }}
        />
      </QueryClientProvider>
    </AuthProvider>
  );
}
