import { Heading } from "../ui/Heading";
import { Logo } from "../ui/Logo";
import { BackButton } from "../ui/BackButton";
import { HikeForm } from "../features/hikes/components/HikeForm";

export function CreateHike() {
  return (
    <>
      <BackButton />
      <Logo />
      <Heading>Create a new hike</Heading>
      <div className="flex justify-center">
        <div className="w-md">
          <HikeForm />
        </div>
      </div>
    </>
  );
}
