@extends('layouts.basic')
@section('content')
    <ul class="nav justify-content-center fixed-top py-2 help-top-nav">
        <li class="nav-item">
            <a class="nav-link text-center">
                <h5 class="d-none d-md-block full-title">
                    Administration Panel Documentation
                </h5>
                <h5 class="d-md-none cut-title">
                    <span>AP</span> Documentation
                </h5>
            </a>
        </li>
    </ul>
    <br><br><br><br>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-12">
                    <div class="toc js-toc pl-5">
                        <h5>Contents:</h5>
                        <div class="help-border"></div>
                        <ul class="js-toc-list">
                            <li>
                                <a href="#overview">Overview</a>
                            </li>
                            <li>
                                <a href="#dashboard">Dashboard</a>
                            </li>
                            <li>
                                <a href="#modules">Modules</a>
                            </li>
                            <li>
                                <a href="#forms">Forms</a>
                            </li>
                            <li>
                                <a href="#static">Static Blocks</a>
                            </li>
                            <li>
                                <a href="#translations">Translations</a>
                            </li>
                            <li>
                                <a href="#settings">Settings</a>
                            </li>
                            <li>
                                <a href="#administrators">Administrators</a>
                            </li>
                            <li>
                                <a href="#system">System Settings</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-12 help-content-container">
                    <h1 id="overview" class="help-title">Overview</h1>

                    <p>The Administration panel is a way to operate almost all of the functionality of your website. It provides an easy an user friendly way of adding content, managing resources, users, etc. This documentation will provide you with the basic usage of all components, that you might encounter (It will explain how to add content on specific pages, what information to put where, etc.). If you have any questions you can
                        <a href="#email">e-mail us</a>. We will be happy to help.</p>

                    <h1 id="dashboard" class="help-title">Dashboard</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="modules" class="help-title">Modules</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="forms" class="help-title">Forms</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="static" class="help-title">Static Blocks</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="translations" class="help-title">Translations</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="settings" class="help-title">Settings</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="administrators" class="help-title">Administrators</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="system" class="help-title">System Settings</h1>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore hic omnis vitae error blanditiis amet corporis sit est mollitia inventore rem, temporibus, voluptate incidunt accusamus eius illum nulla, assumenda sint.
                        Earum animi at magni amet aliquid tempora, iusto temporibus, provident odit tempore blanditiis modi voluptatem neque perferendis incidunt ad ipsa placeat laudantium nam sit officia. Quos aperiam aspernatur magni inventore.
                        Natus, facere ex molestiae culpa, sunt officiis sit ipsam voluptatem, pariatur voluptas omnis et hic doloremque iste labore dolore? Labore, porro cum voluptas eum tenetur iure pariatur fugiat iusto quia?</p>

                    <h1 id="email" class="help-title">E-mail Us</h1>



                </div>
            </div>
        </div>
    </div>


@endsection