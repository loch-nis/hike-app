import { useState } from "react";
import { useCreatePersonalChecklistItem } from "../hooks/useCreatePersonalChecklistItem";
import { Button } from "../../../../ui/Button";
import { Input } from "../../../../ui/Input";
import { SpinnerMini } from "../../../../ui/SpinnerMini";

export function PersonalChecklistForm({ hikeId }) {
  const { createItem, isPending } = useCreatePersonalChecklistItem();
  const [itemName, setItemName] = useState("");

  function handleSubmit(event) {
    event.preventDefault();

    if (!itemName.trim()) return;

    createItem(
      { hikeId, content: itemName },
      { onSettled: () => setItemName("") },
    );
  }
  return (
    <form className="space-y-2" onSubmit={(event) => handleSubmit(event)}>
      <Input
        type="text"
        placeholder="Enter item..."
        value={itemName}
        onChange={(event) => setItemName(event.target.value)}
      />
      <Button type="submit" disabled={isPending || !itemName.trim()}>
        {isPending ? <SpinnerMini /> : "Add new item"}
      </Button>
    </form>
  );
}
