import { useMutation, useQueryClient } from "@tanstack/react-query";
import { toggleCommonChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";

export function useToggleCommonChecklistItem() {
  const queryClient = useQueryClient();

  const { mutate: toggleItem, isPending } = useMutation({
    mutationFn: ({ itemId }) => toggleCommonChecklistItemApi({ itemId }),
    onMutate: async ({ itemId }) => {
      await queryClient.cancelQueries({ queryKey: ["commonChecklist"] });
      const previousItems = queryClient.getQueryData(["commonChecklist"]);
      queryClient.setQueryData(["commonChecklist"], (old) => {
        if (!old) return old;
        return old.items.map((item) =>
          item.id === itemId ? { ...item, isChecked: !item.isChecked } : item,
        );
      });
      return { previousItems };
    },
    onError: (error, _, context) => {
      toast.error("Error checking item: ", error);
      queryClient.setQueryData(["commonChecklist"], context.previousItems);
    },
    onSettled: () =>
      queryClient.invalidateQueries({ queryKey: ["commonChecklist"] }),
  });

  return { toggleItem, isPending };
}
