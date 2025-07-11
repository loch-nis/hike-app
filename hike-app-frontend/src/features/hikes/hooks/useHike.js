import { useQuery } from "@tanstack/react-query";
import { fetchHikeApi } from "../../../services/apiHikes";

export function useHike({ hikeId }) {
  const {
    data: hike,
    error,
    isPending,
    isError,
  } = useQuery({
    queryKey: ["hike", hikeId],
    queryFn: () => fetchHikeApi({ hikeId }),
  });

  return { hike, error, isPending, isError };
}
