import { useMutation, useQueryClient } from "@tanstack/react-query";
import { createHikeApi } from "../../../services/apiHikes";
import toast from "react-hot-toast";
import { useNavigate } from "react-router-dom";

export function useCreateHike() {
  const navigate = useNavigate();
  const queryClient = useQueryClient();

  const { mutate: createHike, isPending } = useMutation({
    mutationFn: ({ title }) => createHikeApi({ title }),
    onSuccess: () => {
      queryClient.invalidateQueries(["hikes"]);
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
