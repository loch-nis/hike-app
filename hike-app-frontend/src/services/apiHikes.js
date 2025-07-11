import { apiClient } from "./apiClient";

export async function fetchAllHikesApi() {
  const response = await apiClient.get("/hikes");

  return response.data;
}

export async function fetchHikeApi({ hikeId }) {
  const response = await apiClient.get(`/hikes/${hikeId}`);
  return response.data;
}

export async function createHikeApi({ title }) {
  const response = await apiClient.post("/hikes", {
    title,
  });
  console.log(response);
  return response.data;
}

// todo remap like this? const hikes = response.data.map((hike) => { first_name: firstName, title, })
