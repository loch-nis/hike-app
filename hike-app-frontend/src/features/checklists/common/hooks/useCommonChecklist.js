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
    isCommonChecklistReady: !isPending && !isError && data,
    error,
    isPending,
    isError,
  };
}
