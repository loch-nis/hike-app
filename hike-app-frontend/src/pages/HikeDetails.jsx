import { useState } from "react";
import { useParams } from "react-router-dom";
import { BackButton } from "../ui/BackButton";
import { useHike } from "../features/hikes/hooks/useHike";
import { Spinner } from "../ui/Spinner";
import { usePersonalChecklist } from "../features/checklists/personal/hooks/usePersonalChecklist";
import { Input } from "../ui/Input";
import { Button } from "../ui/Button";
import { useCreatePersonalChecklistItem } from "../features/checklists/personal/hooks/useCreatePersonalChecklistItem";
import { CommonChecklist } from "../features/checklists/common/components/CommonChecklist";
import { Title } from "../ui/Title";
import { PersonalChecklistItem } from "../features/checklists/personal/components/PersonalChecklistItem";
import { Checkbox } from "react-aria-components";

export function HikeDetails() {
  const { hikeId } = useParams();
  const { hike, error, isPending, isError } = useHike({ hikeId });

  return (
    <>
      <BackButton />
      {isPending ? (
        <Spinner />
      ) : isError ? (
        <Error error={error} />
      ) : (
        <>
          <Title title={hike.title} />
          <div className="flex justify-center gap-10">
            <ChecklistBox>
              <h3 className="py-2">Personlig huskeliste</h3>
              <PersonalChecklist hikeId={hikeId} />
            </ChecklistBox>
            <ChecklistBox>
              <CommonChecklist />
            </ChecklistBox>
          </div>
          <PersonalChecklistForm hikeId={hikeId} />
        </>
      )}
    </>
  );
}

function ChecklistBox({ children }) {
  return (
    <div className="relative w-[24rem] max-w-[24rem] bg-[var(--color-background-500)] font-mono">
      {children}
    </div>
  );
}

function PersonalChecklist({ hikeId }) {
  const { items, error, isPending, isError } = usePersonalChecklist({ hikeId });

  if (isPending) return <Spinner />;

  return (
    <ul className="flex flex-col space-y-0.5">
      {items.map((item) => (
        <PersonalChecklistItem item={item} key={item.id} />
      ))}
    </ul>
  );
}

function PersonalChecklistForm({ hikeId }) {
  const { createPersonalChecklistItem, isPending } =
    useCreatePersonalChecklistItem();

  //temp
  const [itemName, setItemName] = useState("");

  function handleSubmit(event) {
    event.preventDefault();

    if (!itemName) return;
    createPersonalChecklistItem(
      { hikeId, content: itemName },
      {
        onSettled: () => {
          setItemName("");
          console.log("successdwadawd");
        },
      },
    );
  }
  return (
    <form onSubmit={(event) => handleSubmit(event)}>
      <Input
        type="text"
        value={itemName}
        onChange={(event) => setItemName(event.target.value)}
      />
      <Button>button</Button>
    </form>
  );
}
