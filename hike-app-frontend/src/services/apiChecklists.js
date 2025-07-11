import { apiClient } from "./apiClient";
import camelcaseKeys from "camelcase-keys";

export async function fetchAllPersonalChecklistItemsApi({ hikeId }) {
  const response = await apiClient.get(
    `/hikes/${hikeId}/me/personal-checklist`,
  );
  // todo idk how I feel about this structure. At least be consistent?
  const items = camelcaseKeys(response.data.data, { deep: true });
  return { items };
}

export async function createPersonalChecklistItemApi({ hikeId, content }) {
  const response = await apiClient.post(
    `/hikes/${hikeId}/me/personal-checklist-items`,
    { content },
  );
  return response.data;
}

export async function togglePersonalChecklistItemApi({ itemId }) {
  const response = await apiClient.patch(`/personal-checklist-items/${itemId}`);
  return response.data;
}

export async function deletePersonalChecklistItemApi({ itemId }) {
  const response = await apiClient.delete(
    `/personal-checklist-items/${itemId}`,
  );
  return response.data;
}
