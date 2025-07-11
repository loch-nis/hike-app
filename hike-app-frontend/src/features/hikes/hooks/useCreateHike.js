import { useMutation } from "@tanstack/react-query";
import { createHikeApi } from "../../../services/apiHikes";
import toast from "react-hot-toast";
import { useNavigate } from "react-router-dom";

export function useCreateHike() {
  const navigate = useNavigate();

  // todo import queryClient and invalidate

  const { mutate: createHike, isPending } = useMutation({
    mutationFn: ({ title }) => createHikeApi({ title }),
    onSuccess: () => {
      toast.success("Hike succesfully created!");
      navigate("/hikes");
    },
    onError: (error) => {
      console.log(error);
      toast.error("Error in creating hike");
    },
  });

  return { createHike, isPending };
}
