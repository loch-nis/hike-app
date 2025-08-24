import { useQuery } from "@tanstack/react-query";
import { fetchAllCommonChecklistItemsApi } from "../../../../services/apiChecklists";

export function useCommonChecklist({ hikeId }) {
  const { data, error, isPending, isError } = useQuery({
    queryKey: ["commonChecklist", hikeId],
    queryFn: () => fetchAllCommonChecklistItemsApi({ hikeId }),
  });

  return {
    commonChecklistItems: data?.data ?? [],
    commonChecklist: data?.checklist ?? {},
    error,
    isPending,
    isError,
  };
}

// todo can I reuse logic for personal and common hooks? or maybe just don't. do this later if it makes sense..
