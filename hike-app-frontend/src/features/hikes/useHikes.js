import { useQuery } from "@tanstack/react-query";
import { fetchAllHikesApi } from "../../services/apiHikes";

export function useHikes() {
  const { data, error, isPending, isError } = useQuery({
    queryKey: ["hikes"],
    queryFn: fetchAllHikesApi,
  });

  return { data, error, isPending, isError };
}
