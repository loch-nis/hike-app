import { Spinner } from "../../../ui/Spinner";
import { useHikes } from "../hooks/useHikes";
import { HikeButton } from "./HikeButton";

export function HikeList() {
  const { hikes, error, isPending, isError } = useHikes();

  if (isError) return <Error error={error} />;

  if (isPending) return <Spinner />;

  return (
    <>
      {hikes.length > 0
        ? hikes.map((hike) => <HikeButton hike={hike} key={hike.id} />)
        : "You have no hikes."}
    </>
  );
}
