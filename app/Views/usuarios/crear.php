<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content',$titulo) ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <h1>Crear Usuario</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                <li class="breadcrumb-item"><a href="usuarios">Administrar usuarios</a></li>
                <li class="breadcrumb-item active">Crear Usuario</li>
            </ol>
          </div>
        </div>
        <div class="row" style="justify-content: center; align-items: center;">
            <div class="col-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de creacion de usuario</h3>
                    </div>
                    <form action="guardarUsuario" method="POST" enctype="multipart/form-data">
                        <?php if(session('mensaje')){?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo session('mensaje') ?>
                            </div>
                        <?php }  ?> 
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_persona">Seleccionar Persona *</label>
                                <select id="id_persona" class="custom-select" name="id_persona" placeholder="rol">
                                    <option value="">Escoja una persona</option>
                                    <option value="1">John Davis</option>
                                    <option value="2">Fernando Cervantes</option>
                                    <option value="3">3Fernando Cervantes</option>
                                    <option value="4">4Fernando Cervantes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Nombre de Usuario *</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña *</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                                <label for="id_rol">Rol de Usuario *</label>
                                <select id="id_rol" class="custom-select" name="id_rol" placeholder="rol">
                                    <option value="">Seleccionar Rol</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Empleado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="imagen" required>
                                        <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection() ?>