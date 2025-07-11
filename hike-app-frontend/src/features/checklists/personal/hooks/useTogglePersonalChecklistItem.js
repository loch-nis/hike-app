import { useMutation, useQueryClient } from "@tanstack/react-query";
import { togglePersonalChecklistItemApi } from "../../../../services/apiChecklists";
import toast from "react-hot-toast";
import { useState } from "react";

export function useTogglePersonalChecklistItem(item) {
  const queryClient = useQueryClient();
  const [isChecked, setIsChecked] = useState(item.isChecked);

  const { mutate: toggleItem, isPending } = useMutation({
    mutationFn: ({ itemId }) => togglePersonalChecklistItemApi({ itemId }),
    onMutate: () => setIsChecked((prev) => !prev), // why?
    onSuccess: () => {
      queryClient.invalidateQueries(["personalChecklist"]);
    },
    onError: (error) => {
      setIsChecked((prev) => !prev);
      toast.error("Error checking item");
    },
  }); // Whats the diff between mutateFn and onMutate ? :D

  return { isChecked, toggleItem, isPending };
}
