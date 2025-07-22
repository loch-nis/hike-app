import { useMutation, useQueryClient } from "@tanstack/react-query";
import { deleteCommonChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";

export function useDeleteCommonChecklistItem() {
  const queryClient = useQueryClient();

  const { mutate: deleteItem, isPending } = useMutation({
    mutationFn: ({ itemId }) => deleteCommonChecklistItemApi({ itemId }),
    onSuccess: () =>
      queryClient.invalidateQueries({ queryKey: ["commonChecklist"] }),
    onError: (error) => {
      toast.error("Error checking item: ", error);
    },
  });

  return { deleteItem, isPending };
}
