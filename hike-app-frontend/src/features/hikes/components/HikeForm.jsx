import { useState } from "react";
import { Button } from "../../../ui/Button";
import { FormRow } from "../../../ui/FormRow";
import { Input } from "../../../ui/Input";
import { useCreateHike } from "../hooks/useCreateHike";
import { SpinnerMini } from "../../../ui/SpinnerMini";

export function HikeForm() {
  const [title, setTitle] = useState("");
  const { createHike, isPending } = useCreateHike();

  function handleSubmit(event) {
    event.preventDefault();

    if (!title) return;

    createHike({ title });
  }

  // todo - for the email field, I could make it a Tags Input like https://github.com/shadcn-ui/ui/issues/3647
  // todo and then it could look up the email immidiately, and be green and show the user first name if found, otherwise send an email with mailgun and invite to the app

  return (
    <form className="space-y-6" onSubmit={(event) => handleSubmit(event)}>
      <FormRow htmlFor="title" label="Title">
        <Input
          id="title"
          name="title"
          type="text"
          required
          disabled={isPending}
          value={title}
          onChange={(event) => setTitle(event.target.value)}
        />
      </FormRow>
      <FormRow htmlFor="email" label="Invite participants">
        <Input
          id="email"
          name="email"
          type="email"
          disabled
          placeholder="Emails here..."
        />
      </FormRow>
      <Button type="submit" disabled={isPending}>
        {isPending ? <SpinnerMini /> : "Create hike"}
      </Button>
    </form>
  );
}
