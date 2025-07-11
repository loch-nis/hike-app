import { useQuery } from "@tanstack/react-query";
import { fetchAllPersonalChecklistItemsApi } from "../../../../services/apiChecklists";

export function usePersonalChecklist({ hikeId }) {
  const { data, error, isPending, isError } = useQuery({
    queryKey: ["personalChecklist", hikeId],
    queryFn: () => fetchAllPersonalChecklistItemsApi({ hikeId }),
  });

  return {
    items: data?.items ?? [],
    error,
    isPending,
    isError,
  };
}
