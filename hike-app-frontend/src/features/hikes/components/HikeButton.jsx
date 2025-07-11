import { faTree } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Link } from "react-router-dom";

export function HikeButton({ hike }) {
  return (
    <Link
      to={`/hikes/${hike.id}`}
      className="group rounded-full border-2 border-black px-5 py-3 shadow-md hover:bg-green-700 hover:text-white"
    >
      <span className="mr-2">
        <FontAwesomeIcon icon={faTree} className="group-hover:text-green-500" />
      </span>
      {hike.title}
    </Link>
  );
}
