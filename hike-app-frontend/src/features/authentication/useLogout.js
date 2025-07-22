import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";

export function useLogout() {
  const navigate = useNavigate();
  const queryClient = useQueryClient();
  const { logout: logoutWithContext } = useAuth();

  const { mutate: logout } = useMutation({
    mutationFn: logoutWithContext,
    onSuccess: () => {
      queryClient.clear();
      navigate("auth/login", { replace: true });
    },
  });

  return { logout };
}
