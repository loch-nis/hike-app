import { faPlus, faTree } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Logo } from "../ui/Logo";
import { Link } from "react-router-dom";

const hikeExample = {
  id: "c1cbb65f-3373-4a7c-9cb7-8ad5c8e451d7",
  title: "Sommertur",
  created_at: "2025-06-28T18:37:37.000000Z",
  updated_at: "2025-06-28T18:37:37.000000Z",
  laravel_through_key: 4,
};
const hikesExample = [
  hikeExample,
  {
    id: "cabcd65f-3373-4a7c-9cb7-8ad5c8e451d7",
    title: "Vintertur",
    created_at: "2025-06-28T19:37:37.000000Z",
    updated_at: "2025-06-28T19:37:37.000000Z",
    laravel_through_key: 4,
  },
  {
    id: "Xabcd95f-3373-4a7c-9cb7-8ad5c8e451d7",
    title: "ekstra sej lang testsetestestest  testsetstestsetest Vintertur",
    created_at: "2025-06-28T19:37:37.000000Z",
    updated_at: "2025-06-28T19:37:37.000000Z",
    laravel_through_key: 4,
  },
];

export default function Hikes() {
  // todo remember to remap first_name=>firstName, probably in the context or hooks
  return (
    <>
      <Logo />
      <div className="flex flex-col items-center gap-2">
        <ButtonList hikes={hikesExample} />
        <NewButton buttonText={"New hike"} />
      </div>
    </>
  );
}

function ButtonList({ hikes }) {
  return (
    <>
      {hikes ? (
        hikes.map((hike) => <HikeButton hike={hike} key={hike.id} />)
      ) : (
        <p>no hikes</p>
      )}
    </>
  );
}

function HikeButton({ hike }) {
  return (
    <Link
      to={`/hikes/${hike.id}`}
      className="rounded-full border-2 px-5 py-3 shadow-md hover:bg-gray-200"
    >
      <span className="mr-2">
        <FontAwesomeIcon icon={faTree} />
      </span>
      {hike.title}
    </Link>
  );
}

function NewButton({ buttonText }) {
  return (
    <Link
      to={"/hikes/new"}
      className="bg-brand-orange hover:bg-brand-bronze rounded-full border-2 px-5 py-3 shadow-md"
    >
      <span className="mr-[10px]">
        <FontAwesomeIcon icon={faPlus} />
      </span>
      <span>{buttonText}</span>
    </Link>
  );
}
