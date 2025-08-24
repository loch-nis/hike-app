import { it, test, expect, describe } from "vitest";
import { render, screen } from "@testing-library/react";
import { AuthContext, useAuth } from "../../src/context/AuthContext";

// todo all this..
it("allows a user to log in", () => {
  const providerProps = {};
});

test("login sets token expiry (both locally and in localstorage???????)", () => {
  const { login: loginWithContext } = useAuth();
  loginWithContext({ email: "es@cia.gov", password: "123" });

  console.log();
});

const customRender = (ui, { providerProps, ...renderOptions }) => {
  return render(
    <AuthContext.Provider {...providerProps}>{ui}</AuthContext.Provider>,
    renderOptions,
  );
};

test("mounting with token");
test("mounting without token");
test("mounting with expired token");
