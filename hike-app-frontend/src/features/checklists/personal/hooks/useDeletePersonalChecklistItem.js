import { useMutation, useQueryClient } from "@tanstack/react-query";
import { deletePersonalChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";

export function useDeletePersonalChecklistItem() {
  const queryClient = useQueryClient();

  const { mutate: deleteItem, isPending } = useMutation({
    mutationFn: ({ itemId }) => deletePersonalChecklistItemApi({ itemId }),
    onSuccess: () =>
      queryClient.invalidateQueries({ queryKey: ["personalChecklist"] }),
    onError: (error) => {
      toast.error("Error checking item: ", error);
    },
  });

  return { deleteItem, isPending };
}
