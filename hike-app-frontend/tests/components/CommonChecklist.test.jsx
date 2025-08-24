import { it, expect, describe } from "vitest";
import { render, screen } from "@testing-library/react";

describe("CommonChecklist", () => {
  it("triggers a re-render for another client when a common checklist item is updated", () => {
    // wait, this is an e2e test, since backend is involved.
    // so either don't test this with Vitest at all, or test each functionality individually..
    // todo test event - maybe measure time to see if actually real-time? with Playwright vscode extension
  });
});
