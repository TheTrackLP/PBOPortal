import { createRouter, createWebHistory } from "vue-router";
import { supabase } from "@/lib/supabase";

const routes = [
  {
    path: "/",
    component: () => import("@/layouts/Frontend/AppLayout.vue"),
    children: [
      {
        path: "",
        name: "Home",
        component: () => import("@/pages/Frontend/Home.vue"),
      },
      {
        path: "about",
        name: "About",
        component: () => import("@/pages/Frontend/About.vue"),
      },
      {
        path: "accomplishments",
        name: "Accomplishments",
        component: () => import("@/pages/Frontend/Accomplishments.vue"),
      },
      {
        path: "staff",
        name: "Staff",
        component: () => import("@/pages/Frontend/Staff.vue"),
      },
      {
        path: "contactus",
        name: "ContactUs",
        component: () => import("@/pages/Frontend/Contact.vue"),
      },
    ],
  },
  {
    path: "/admin/login",
    name: "AdminLogin",
    component: () => import("@/pages/Backend/Admin/Login.vue"),
  },
  {
    path: "/admin",
    component: () => import("@/layouts/Backend/AdminLayout.vue"),
    children: [
      {
        path: "dashboard",
        name: "AdminDashboard",
        component: () => import("@/pages/Backend/Admin/Dashboard.vue"),
      },
      {
        path: "staff",
        name: "AdminStaff",
        component: () => import("@/pages/Backend/Admin/pages/Staffs.vue"),
      },
      {
        path: "division",
        name: "AdminDivision",
        component: () => import("@/pages/Backend/Admin/pages/Division.vue"),
      },
      {
        path: "about",
        name: "AdminAbout",
        component: () => import("@/pages/Backend/Admin/pages/About.vue"),
      },
      {
        path: "settings",
        name: "AdminSettings",
        component: () => import("@/pages/Backend/Admin/pages/Settings.vue"),
      },
      {
        path: "accomplishments",
        name: "AdminAccomplishments",
        component: () =>
          import("@/pages/Backend/Admin/pages/Accomplishments.vue"),
      },
    ],
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth) {
    const { data } = await supabase.auth.getSession();
    if (!data.session) {
      next({ name: "AdminLogin" });
      return;
    }
  }
  next();
});

export default router;
