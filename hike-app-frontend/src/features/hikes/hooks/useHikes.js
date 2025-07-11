import { useQuery } from "@tanstack/react-query";
import { fetchAllHikesApi } from "../../../services/apiHikes";

export function useHikes() {
  const {
    data: hikes,
    error,
    isPending,
    isError,
  } = useQuery({
    queryKey: ["hikes"],
    queryFn: fetchAllHikesApi,
  });

  return { hikes, error, isPending, isError };
}
