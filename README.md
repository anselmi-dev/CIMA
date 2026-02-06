# CIMA - Sistema de Gestión de Citas Médicas

## 📋 Descripción del Proyecto

CIMA es una aplicación web desarrollada en Laravel para la gestión de citas médicas. El sistema permite a los pacientes agendar citas con profesionales de la salud según especialidades médicas y horarios disponibles. 

El sistema contempla un flujo completo de reserva de citas que incluye:
- Selección de especialidad médica
- Visualización de profesionales disponibles
- Selección de horarios según disponibilidad
- Reserva de citas (presenciales o virtuales)
- Sistema de pagos por transferencia bancaria
- Gestión automática de cancelaciones y liberación de horarios

### Características Principales

- **Gestión de Especialidades Médicas**: Catálogo de especialidades con descripción
- **Gestión de Profesionales**: Perfiles de profesionales con especialidades asociadas
- **Sistema de Horarios**: Configuración de horarios disponibles por profesional y día de la semana
- **Reserva de Citas**: Sistema completo de agendamiento con validaciones
- **Tipos de Cita**: Soporte para citas presenciales y virtuales
- **Sistema de Pagos**: Integración con transferencias bancarias
- **Gestión de Tiempo**: Liberación automática de citas no pagadas después de 15 minutos
- **Notificaciones por Email**: Envío automático de correos electrónicos para diferentes eventos
- **Panel de Administración**: Interfaz completa de administración con Filament
- **Gestión de Pacientes**: Registro y seguimiento de pacientes

## 🏗️ Arquitectura y Componentes

### Stack Tecnológico

- **Backend**: Laravel 11.x
- **Frontend**: Livewire 3.x, TailwindCSS
- **Panel Admin**: Filament 3.x
- **Base de Datos**: SQLite (desarrollo) / MySQL/PostgreSQL (producción)
- **Autenticación**: Laravel Jetstream con Sanctum
- **Notificaciones**: Sistema de eventos y listeners de Laravel

### Estructura del Proyecto

```
app/
├── Actions/              # Acciones de Fortify y Jetstream
├── Casts/               # Casts personalizados (StatusCast)
├── DataTypes/           # Tipos de datos personalizados (Status)
├── Events/              # Eventos de la aplicación
│   ├── AppointmentCreated.php
│   └── AppointmentUpdated.php
├── Filament/            # Recursos del panel de administración
│   ├── Resources/       # CRUDs de Filament
│   ├── Pages/          # Páginas personalizadas
│   └── Widgets/        # Widgets del dashboard
├── Http/
│   ├── Controllers/    # Controladores
│   └── Requests/      # Form Requests
├── Listeners/          # Listeners de eventos
│   ├── SendAppointmentCreatedNotification.php
│   └── SendAppointmentUpdatedNotification.php
├── Livewire/           # Componentes Livewire (frontend)
│   ├── Schedule.php    # Componente principal de agendamiento
│   ├── ScheduleSuccess.php
│   ├── ScheduleConfirm.php
│   └── ScheduleCanceled.php
├── Mail/               # Clases de correo electrónico
│   ├── AppointmentCreatedMail.php
│   ├── AppointmentPaymentMail.php
│   ├── AppointmentScheduledMail.php
│   └── AppointmentToPatientCancel.php
├── Models/             # Modelos Eloquent
│   ├── Appointment.php
│   ├── Professional.php
│   ├── Patient.php
│   ├── MedicalSpecialty.php
│   ├── ProfessionalSchedule.php
│   ├── Payment.php
│   └── Transaction.php
├── Notifications/      # Notificaciones
└── Observers/         # Observers de modelos
```

## 📊 Modelos Principales

### Appointment (Cita)
Modelo central del sistema que representa una cita médica.

**Relaciones:**
- `belongsTo(Professional::class)` - Profesional que atiende
- `belongsTo(Patient::class)` - Paciente
- `belongsTo(MedicalSpecialty::class)` - Especialidad médica

**Atributos principales:**
- `uuid`: Identificador único para acceso público
- `start_at` / `end_at`: Fecha y hora de la cita
- `status`: Estado de la cita (pending, payment, scheduled, cancelled, completed)
- `is_presence`: Tipo de cita (presencial/virtual)
- `data`: Información adicional en formato JSON

**Eventos:**
- `AppointmentCreated`: Se dispara al crear una cita
- `AppointmentUpdated`: Se dispara al actualizar una cita

### Professional (Profesional)
Representa a un profesional de la salud.

**Relaciones:**
- `belongsTo(User::class)` - Usuario del sistema
- `hasMany(ProfessionalSchedule::class)` - Horarios disponibles
- `hasMany(Appointment::class)` - Citas asignadas
- `belongsToMany(MedicalSpecialty::class)` - Especialidades
- `hasMany(ProfessionalBankAccount::class)` - Cuentas bancarias

### Patient (Paciente)
Representa a un paciente del sistema.

**Relaciones:**
- `belongsTo(Professional::class)` - Profesional asociado
- `hasMany(Appointment::class)` - Citas del paciente

### MedicalSpecialty (Especialidad Médica)
Catálogo de especialidades médicas disponibles.

**Relaciones:**
- `belongsToMany(Professional::class)` - Profesionales con esta especialidad

### ProfessionalSchedule (Horario del Profesional)
Define los horarios disponibles de un profesional por día de la semana.

**Atributos:**
- `day_of_week`: Día de la semana (0-6)
- `time`: Array con rangos de horarios
- `is_presence`: Si el horario es para citas presenciales

### Payment (Pago)
Registra los pagos asociados a las citas.

**Relaciones:**
- `belongsTo(Appointment::class)` - Cita asociada

**Atributos:**
- `amount`: Monto del pago
- `method`: Método de pago
- `status`: Estado del pago (pending, completed, failed)

## 🔄 Flujo de Citas

### 1. Selección de Especialidad
El paciente accede a `/agendar/` y selecciona una especialidad médica.

### 2. Selección de Profesional y Horario
- Se muestra un calendario con los profesionales disponibles
- El paciente selecciona un profesional y una fecha
- Se muestran los horarios disponibles según el `ProfessionalSchedule`
- El paciente selecciona un horario disponible

### 3. Registro de Datos del Paciente
El paciente completa un formulario con:
- Nombre y apellido
- Email
- Teléfono
- RUT/DNI
- Fecha de nacimiento

### 4. Creación de la Cita
- Se crea o actualiza el registro del `Patient`
- Se crea la `Appointment` con estado `pending`
- Se dispara el evento `AppointmentCreated`
- Se envía notificación por email al paciente

### 5. Proceso de Pago
- La cita queda en estado `pending` esperando pago
- El sistema muestra información de transferencia bancaria
- **Importante**: Si la cita no se paga en 15 minutos, se libera automáticamente

### 6. Confirmación de Pago
- El administrador marca el pago como recibido
- El estado cambia a `payment` y luego a `scheduled`
- Se dispara el evento `AppointmentUpdated`
- Se envían correos al profesional y al paciente

### 7. Cancelación
- Las citas pueden cancelarse en cualquier momento
- Al cancelar, el estado cambia a `cancelled`
- Se libera el horario para otros pacientes
- Se envía notificación de cancelación

## 💳 Sistema de Pagos

El sistema utiliza transferencias bancarias como método de pago:

1. **Información Bancaria**: Cada profesional puede tener cuentas bancarias asociadas
2. **Cuentas Administrativas**: El sistema tiene cuentas bancarias administrativas para recibir pagos
3. **Registro de Pagos**: Los pagos se registran manualmente por el administrador
4. **Transacciones**: Se registran todas las transacciones en la tabla `transactions`

### Estados de Pago
- `pending`: Esperando pago
- `payment`: Pago registrado, esperando confirmación
- `scheduled`: Cita confirmada y agendada

## ⏱️ Sistema de Liberación Automática (15 minutos)

El sistema contempla que si una cita no se paga en un período de 15 minutos, se desbloquea automáticamente. Esto permite que otros pacientes puedan reservar ese horario.

**Nota**: Esta funcionalidad debe implementarse mediante:
- Un comando de consola programado (Cron Job)
- Un Job en cola que verifique citas pendientes
- O un sistema de eventos temporales

## 📧 Sistema de Notificaciones

El sistema envía correos electrónicos automáticamente mediante eventos:

### Eventos y Listeners

**AppointmentCreated:**
- `SendAppointmentCreatedNotification`: Envía email al paciente con detalles de la cita

**AppointmentUpdated:**
- `SendAppointmentUpdatedNotification`: 
  - Si estado es `payment`: Envía email al administrador
  - Si estado es `scheduled`: Envía email al profesional y al paciente
  - Si estado es `cancelled`: Envía email de cancelación al paciente

### Clases de Correo
- `AppointmentCreatedMail`: Confirmación de creación de cita
- `AppointmentPaymentMail`: Notificación de pago al administrador
- `AppointmentScheduledMail`: Confirmación de cita agendada (profesional)
- `AppointmentToPatientScheduledMail`: Confirmación de cita agendada (paciente)
- `AppointmentToPatientCancel`: Notificación de cancelación

## 🎨 Panel de Administración (Filament)

El sistema incluye un panel completo de administración con Filament que permite gestionar:

- **Usuarios**: Gestión de usuarios del sistema
- **Profesionales**: CRUD completo de profesionales con gestión de horarios y cuentas bancarias
- **Especialidades Médicas**: Gestión del catálogo de especialidades
- **Pacientes**: Gestión de pacientes y sus citas
- **Citas**: Visualización y gestión de todas las citas
- **Pagos**: Gestión de pagos y transacciones
- **Bancos**: Catálogo de bancos
- **Cuentas Bancarias**: Gestión de cuentas de profesionales y administradores

## 🚀 Instalación y Configuración

### Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- Base de datos (SQLite para desarrollo, MySQL/PostgreSQL para producción)
- Servidor web (Apache/Nginx) o Laravel Sail

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone <repository-url>
cd cima
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node**
```bash
npm install
```

4. **Configurar el archivo de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar la base de datos en `.env`**
```env
DB_CONNECTION=sqlite
# O para MySQL/PostgreSQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=cima
# DB_USERNAME=root
# DB_PASSWORD=
```

6. **Crear la base de datos SQLite (si usas SQLite)**
```bash
touch database/database.sqlite
```

7. **Ejecutar migraciones**
```bash
php artisan migrate
```

8. **Ejecutar seeders (opcional)**
```bash
php artisan db:seed
```

9. **Compilar assets**
```bash
npm run dev
# O para producción:
npm run build
```

10. **Configurar el servidor de desarrollo**
```bash
php artisan serve
```

El proyecto estará disponible en `http://localhost:8000`

### Configuración Adicional

#### Configurar Email
En el archivo `.env`, configura el servicio de correo:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@cima.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_EMAIL=admin@cima.com
```

#### Configurar Cola de Trabajos
Para procesar emails y trabajos en segundo plano, configura una cola:
```env
QUEUE_CONNECTION=database
# O Redis:
# QUEUE_CONNECTION=redis
```

Ejecuta el worker de cola:
```bash
php artisan queue:work
```

#### Configurar Tareas Programadas (Cron)
Para la liberación automática de citas, agrega al crontab:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 📝 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimizar aplicación
php artisan optimize
php artisan filament:optimize

# Generar recursos de Filament
php artisan filament:upgrade

# Ejecutar tests
php artisan test
```

## 🔐 Autenticación

El sistema utiliza Laravel Jetstream con autenticación por sesión. Los profesionales y administradores pueden acceder al panel de administración en `/admin`.

## 📄 Licencia

Este proyecto está bajo la licencia MIT.

## 👥 Contribución

Las contribuciones son bienvenidas. Por favor, abre un issue o un pull request para cualquier mejora.

## 📞 Soporte

Para soporte, contacta al equipo de desarrollo o abre un issue en el repositorio.
