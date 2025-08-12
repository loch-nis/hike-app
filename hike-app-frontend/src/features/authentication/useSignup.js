import { useMutation } from "@tanstack/react-query";
import toast from "react-hot-toast";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";

export function useSignup() {
  const { login: loginWithContext, signup: signupWithContext } = useAuth();
  const navigate = useNavigate();

  const { mutate: signup, isPending } = useMutation({
    mutationFn: ({ firstName, lastName, email, password, passwordConfirm }) =>
      signupWithContext({
        firstName,
        lastName,
        email,
        password,
        passwordConfirm,
      }),
    onSuccess: async (data, { email, password }) => {
      await loginWithContext({ email, password });
      navigate("/hikes", { replace: true });
    },
    onError: (error) => {
      const message =
        error?.response?.data?.message || "Invalid registration info";
      toast.error(message);
    },
  });

  return { signup, isPending };
}
