<script>
import AppLayout from "@/Layouts/Frontend/AppLayout.vue";
export default {
    layout: AppLayout,
};
</script>
<style>
.contact-img {
    width: 63rem;
    object-fit: cover;
    border-radius: 0.5rem;
}
ul,
li {
    font-size: 20px;
}
</style>

<template>
    <div>
        <section class="hero">
            <div class="container position-relative">
                <h1 class="font-display fw-bold">Contact Us</h1>
                <p class="lead m-0">We would love to speak with you.</p>
                <p class="lead m-0">
                    Feel free to reach out using the below details.
                </p>
            </div>
        </section>
        <div class="">
            <div class="row mx-3 my-3 mb-4 g-4">
                <div class="col-md-6 text-center">
                    <img
                        src="img/new-capitol.jpg"
                        alt="Capiz Provincial Seal"
                        class="contact-img"
                    />
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <ul class="list-unstyled mx-5">
                        <li class="d-flex align-items-center mb-3">
                            <i
                                class="bi bi-telephone-fill fs-5 text-warning me-3"
                            ></i>
                            <div>
                                <strong>Phone</strong><br />
                                <i class="fa-solid fa-phone"></i>(036) 621-XXXX
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i
                                class="bi bi-envelope-fill fs-5 text-warning me-3"
                            ></i>
                            <div>
                                <strong>Email</strong><br />
                                <i class="fa-solid fa-at"></i>pbo@capiz.gov.ph
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <div class="row mx-3 mt-5 g-4 d-flex align-items-center">
                <div class="col-md-6">
                    <ul class="list-unstyled mx-5">
                        <li class="d-flex align-items-center mb-3">
                            <i
                                class="bi bi-geo-alt-fill fs-5 text-warning me-3"
                            ></i>
                            <div>
                                <strong>Address</strong><br />
                                Provincial Capitol, Roxas City, Capiz
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <img
                        src="img/new-capitol.jpg"
                        alt="Capiz Provincial Seal"
                        class="contact-img"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
