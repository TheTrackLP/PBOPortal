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
        path: "citizencharter",
        name: "CitizenCharter",
        component: () => import("@/pages/Frontend/CitizenCharter.vue"),
      },
      {
        path: "benefits",
        name: "Benefits",
        component: () => import("@/pages/Frontend/Benefits.vue"),
      },
      {
        path: "news",
        name: "News",
        component: () => import("@/pages/Frontend/News/Index.vue"),
      },
      {
        path: "news/:title",
        name: "NewsView",
        component: () => import("@/pages/Frontend/News/View.vue"),
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
        path: "news",
        name: "AdminNews",
        component: () => import("@/pages/Backend/Admin/pages/News.vue"),
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
        path: "benefits",
        name: "AdminBenefits",
        component: () => import("@/pages/Backend/Admin/pages/Benefits.vue"),
      },
      {
        path: "settings",
        name: "AdminSettings",
        component: () => import("@/pages/Backend/Admin/pages/Settings.vue"),
      },
      {
        path: "citizencharter",
        name: "AdminCitizenCharter",
        component: () =>
          import("@/pages/Backend/Admin/pages/CitizenCharter.vue"),
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
  scrollBehavior(to, from, savedPosition) {
    return { top: 0 };
  },
});

router.beforeEach(async (to) => {
  const needsAuth = to.meta.requiresAuth;
  const isLogin = to.name === "AdminLogin";
  if (!needsAuth && !isLogin) return; // public pages: allow

  const {
    data: { session },
  } = await supabase.auth.getSession();

  // Not logged in
  if (!session) {
    return needsAuth ? { name: "Home" } : undefined;
  }

  // Logged in: check role
  const { data: profile, error } = await supabase
    .from("profiles")
    .select("role")
    .eq("id", session.user.id)
    .maybeSingle();

  const isAdmin = profile?.role === "admin";

  if (isLogin) {
    return isAdmin ? { name: "AdminDashboard" } : undefined; // non-admin may see login page
  }

  if (needsAuth && !isAdmin) {
    return { name: "Home" };
  }
});

export default router;
