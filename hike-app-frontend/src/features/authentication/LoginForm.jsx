import { useState } from "react";
import { FormRow } from "../../ui/FormRow";
import { Input } from "../../ui/Input";
import { useLogin } from "./useLogin";
import { Link } from "react-router-dom";
import { Button } from "../../ui/Button";
import { SpinnerMini } from "../../ui/SpinnerMini";

export function LoginForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { login, isPending } = useLogin();

  function handleSubmit(event) {
    event.preventDefault();
    if (!email || !password) return;

    login(
      { email, password },
      {
        onSettled: () => {
          setPassword("");
        },
      },
    );
  }
  return (
    <form className="space-y-6" onSubmit={(event) => handleSubmit(event)}>
      <FormRow label={"Email address"} htmlFor="email">
        <Input
          id="email"
          name="email"
          type="email"
          required
          autoComplete="email"
          disabled={isPending}
          value={email}
          onChange={(event) => setEmail(event.target.value)}
        />
      </FormRow>
      <FormRow
        label="Password"
        htmlFor="password"
        action={
          <Link
            to="/auth/forgot-password"
            className="text-brand-orange hover:text-brand-bronze font-semibold"
          >
            Forgot password?
          </Link>
        }
      >
        <Input
          id="password"
          name="password"
          type="password"
          required
          autoComplete="current-password"
          disabled={isPending}
          value={password}
          onChange={(event) => setPassword(event.target.value)}
        />
      </FormRow>
      <Button type="submit" disabled={isPending}>
        {isPending ? <SpinnerMini /> : "Log in"}
      </Button>
    </form>
  );
}
