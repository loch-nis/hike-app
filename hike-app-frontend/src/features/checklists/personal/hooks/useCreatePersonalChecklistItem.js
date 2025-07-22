import { useMutation, useQueryClient } from "@tanstack/react-query";
import { createPersonalChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";

export function useCreatePersonalChecklistItem() {
  const queryClient = useQueryClient();

  const { mutate: createItem, isPending } = useMutation({
    mutationFn: ({ hikeId, content }) =>
      createPersonalChecklistItemApi({ hikeId, content }),
    onSuccess: () =>
      queryClient.invalidateQueries({ queryKey: ["personalChecklist"] }),
    onError: (error) => {
      const message =
        error?.response?.data?.message || "Error adding item to checklist";
      toast.error(message);
    },
  });
  return { createItem, isPending };
}
