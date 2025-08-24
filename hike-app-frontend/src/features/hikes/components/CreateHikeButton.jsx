import { faPlus } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Link } from "react-router-dom";

export function CreateHikeButton({ children }) {
  return (
    <Link
      to={"/hikes/create"}
      className="bg-brand-orange group hover:bg-brand-bronze rounded-full border-2 border-black px-5 py-3 shadow-md hover:text-white"
    >
      <span className="mr-[10px]">
        <FontAwesomeIcon icon={faPlus} />
      </span>
      <span>{children}</span>
    </Link>
  );
}
