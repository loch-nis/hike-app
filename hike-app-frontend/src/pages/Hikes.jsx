import { Logo } from "../ui/Logo";
import { HikeList } from "../features/hikes/components/HikeList";
import { CreateHikeButton } from "../features/hikes/components/NewHikeButton";

export function Hikes() {
  return (
    <>
      <Logo />
      <div className="flex flex-col items-center gap-2">
        <HikeList />
        <CreateHikeButton buttonText={"New hike"} />
      </div>
    </>
  );
}
