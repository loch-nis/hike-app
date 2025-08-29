import { describe, it, expect, beforeEach, afterEach, vi } from "vitest";
import {
  setTokenExpiry,
  getTokenExpiry,
  isTokenExpired,
  calculateTokenRefreshDelay,
} from "../../src/services/tokenService";

const NOW = 1_700_000_000_000;

beforeEach(() => {
  localStorage.clear();
  vi.spyOn(Date, "now").mockReturnValue(NOW);
});

afterEach(() => {
  vi.restoreAllMocks();
});

describe("isTokenExpired", () => {
  it("should return true when no expiry is set", () => {
    expect(getTokenExpiry()).toBeNull();
    expect(isTokenExpired()).toBe(true);
  });

  it.each([30, 90, 600])(
    "should return false when the current time is before expiry",
    (expiresIn) => {
      setTokenExpiry(expiresIn, NOW);
      expect(isTokenExpired()).toBe(false);
    },
  );

  it("should return true when the current time is after expiry", () => {
    setTokenExpiry(-10, NOW);
    expect(isTokenExpired()).toBe(true);
  });
});

describe("calculateTokenRefreshDelay", () => {
  it("should return expiry minus now minus 60s when expiry is set", () => {
    setTokenExpiry(120, NOW);
    expect(calculateTokenRefreshDelay()).toBe(60_000);
  });

  it("should return a negative delay when expiry is within the 60s buffer", () => {
    setTokenExpiry(30, NOW);
    expect(calculateTokenRefreshDelay()).toBe(-30_000);
  });

  it("should return null when no expiry is set", () => {
    expect(calculateTokenRefreshDelay()).toBe(null);
  });
});
