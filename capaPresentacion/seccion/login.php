<div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card p-3 bloque">
                    <div class="card-body ">
                    <?php if (isset($_GET["registrarse"])): ?>
                         <form action="../capaNegocio/registrarse.php" method="POST">
                			<h1 class="text-center pb-4" id="white">Registrar usuario</h1>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    placeholder="Ingrese su nombre" value="" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Ingrese su email" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="plan">Plan</label>
                                <SELECT name="plan">
                                <option value="1">Básico</option>
                                <option value="2">Premium</option>    
                                <option value="3">Familiar</option>                   
                                </SELECT>
                            </div>

                            <div class="form-group">
                            <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="**********" value="" required>
                                    <p id="imagenHelp" class="form-text text-muted">Su contraseña debe contener <b class="text-danger">8</b> caracteres como mímimo.</p>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                            </form>
                            <?php
                    else:
                        
                        ?> 
                    <form action="../capaNegocio/login.php" method="POST">
                			<h1 class="text-center pb-4" id="white">Iniciar sesión</h1>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Ingrese su Email" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="**********" value="" required>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Iniciar sesión</button>
                            </form>
                            <form action="index.php?seccion=login&registrarse=true" method="POST">
                            <br>
                            <h2 class="text-center pb-4" id="white">Todavia no te registraste?</h2>
                            <button type="submit" class="btn btn-block btn-primary">Registrarse</button>
                            </form>
                            <?php
                            endif;
                        ?> 
                    </div>
                </div>      
            </div>
        </div>
