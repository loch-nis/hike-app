import { useMutation } from "@tanstack/react-query";
import { useNavigate } from "react-router-dom";
import toast from "react-hot-toast";
import { useAuth } from "../../context/AuthContext";

export function useLogin() {
  const { login: loginWithContext } = useAuth();
  const navigate = useNavigate();

  const { mutate: login, isPending } = useMutation({
    mutationFn: ({ email, password }) => loginWithContext({ email, password }),
    onSuccess: () => {
      navigate("/hikes", { replace: true });
    },
    onError: (error) => {
      if (error.status !== 401) console.log(error);
      toast.error("Invalid email or password");
    },
  });

  return { login, isPending };
}
