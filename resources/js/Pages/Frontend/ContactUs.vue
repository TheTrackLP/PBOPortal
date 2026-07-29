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
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d581.0116852876965!2d122.75354856254049!3d11.582999611561844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a5f2f04fff0d45%3A0xd1dbe4fefc632fd!2sCapiz%20Provincial%20Capitol!5e0!3m2!1sen!2sph!4v1785288588668!5m2!1sen!2sph"
                        width="1000"
                        height="600"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</template>
