import { apiClient } from "./apiClient";
import camelcaseKeys from "camelcase-keys";

// personal
export async function fetchAllPersonalChecklistItemsApi({ hikeId }) {
  const response = await apiClient.get(
    `/hikes/${hikeId}/me/personal-checklist`,
  );
  const data = camelcaseKeys(response.data, { deep: true });
  return data;
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

// common
export async function fetchAllCommonChecklistItemsApi({ hikeId }) {
  const response = await apiClient.get(`/hikes/${hikeId}/common-checklist`);
  const data = camelcaseKeys(response.data, { deep: true });
  return data;
}

export async function createCommonChecklistItemApi({ hikeId, content }) {
  const response = await apiClient.post(
    `/hikes/${hikeId}/common-checklist-items`,
    { content },
  );
  return response.data;
}

export async function toggleCommonChecklistItemApi({ itemId }) {
  const response = await apiClient.patch(`/common-checklist-items/${itemId}`);
  return response.data;
}

export async function deleteCommonChecklistItemApi({ itemId }) {
  const response = await apiClient.delete(`/common-checklist-items/${itemId}`);
  return response.data;
}
