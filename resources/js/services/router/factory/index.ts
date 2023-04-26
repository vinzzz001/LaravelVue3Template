import { Meta } from "../types";
import { RouteComponent } from "vue-router";

export const CREATE_PAGE_NAME = ".create";
export const EDIT_PAGE_NAME = ".edit";
export const OVERVIEW_PAGE_NAME = ".overview";
export const SHOW_PAGE_NAME = ".show";

const defaultMeta = { auth: true, canSeeWhenLoggedIn: true };

export const createShowRoute = (
  module: string,
  component: RouteComponent,
  meta?: Meta
) => ({
  path: `/${module}/:id`,
  name: module + SHOW_PAGE_NAME,
  component,
  meta: meta ? meta : defaultMeta,
});

export const createCreateRoute = (
  module: string,
  component: RouteComponent,
  meta?: Meta
) => ({
  path: `/${module}/create`,
  name: module + CREATE_PAGE_NAME,
  component,
  meta: meta ? meta : defaultMeta,
});

export const createOverviewRoute = (
  module: string,
  component: RouteComponent,
  meta?: Meta
) => ({
  path: `/${module}`,
  name: module + OVERVIEW_PAGE_NAME,
  component,
  meta: meta ? meta : defaultMeta,
});

export const createEditRoute = (
  module: string,
  component: RouteComponent,
  meta?: Meta
) => ({
  path: `/${module}/:id/edit`,
  name: module + EDIT_PAGE_NAME,
  component,
  meta: meta ? meta : defaultMeta,
});
