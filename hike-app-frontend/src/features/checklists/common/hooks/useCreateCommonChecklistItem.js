import { useMutation, useQueryClient } from "@tanstack/react-query";
import { createCommonChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";

export function useCreateCommonChecklistItem() {
  const queryClient = useQueryClient();

  const { mutate: createItem, isPending } = useMutation({
    mutationFn: ({ hikeId, content }) =>
      createCommonChecklistItemApi({ hikeId, content }),
    onSuccess: () =>
      queryClient.invalidateQueries({ queryKey: ["commonChecklist"] }),
    onError: (error) => {
      const message =
        error?.response?.data?.message || "Error adding item to checklist";
      toast.error(message);
    },
  });
  return { createItem, isPending };
}
