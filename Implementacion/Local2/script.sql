USE [master]
GO
/****** Object:  Database [BD_Formulario]    Script Date: 19/2/2020 16:27:34 ******/
CREATE DATABASE [BD_Formulario]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'BD_Formulario', FILENAME = N'D:\Bases_SQL\BD_Formulario.mdf' , SIZE = 7168KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'BD_Formulario_log', FILENAME = N'E:\Log_SQL\BD_Formulario_log.ldf' , SIZE = 90432KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [BD_Formulario] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [BD_Formulario].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [BD_Formulario] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [BD_Formulario] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [BD_Formulario] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [BD_Formulario] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [BD_Formulario] SET ARITHABORT OFF 
GO
ALTER DATABASE [BD_Formulario] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [BD_Formulario] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [BD_Formulario] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [BD_Formulario] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [BD_Formulario] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [BD_Formulario] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [BD_Formulario] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [BD_Formulario] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [BD_Formulario] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [BD_Formulario] SET  DISABLE_BROKER 
GO
ALTER DATABASE [BD_Formulario] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [BD_Formulario] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [BD_Formulario] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [BD_Formulario] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [BD_Formulario] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [BD_Formulario] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [BD_Formulario] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [BD_Formulario] SET RECOVERY FULL 
GO
ALTER DATABASE [BD_Formulario] SET  MULTI_USER 
GO
ALTER DATABASE [BD_Formulario] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [BD_Formulario] SET DB_CHAINING OFF 
GO
ALTER DATABASE [BD_Formulario] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [BD_Formulario] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [BD_Formulario] SET DELAYED_DURABILITY = DISABLED 
GO
USE [BD_Formulario]
GO
/****** Object:  Table [dbo].[aplicativo]    Script Date: 19/2/2020 16:27:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[aplicativo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [nvarchar](50) NULL,
	[jefeGerencia] [int] NULL,
	[propietarioGerencia] [int] NULL,
	[nombreBase] [nvarchar](50) NULL,
 CONSTRAINT [PK_aplicativo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[aplicativo_formulario]    Script Date: 19/2/2020 16:27:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[aplicativo_formulario](
	[id] [int] NOT NULL,
	[id_formulario] [int] NULL,
	[id_aplicativo] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_aplicativo_formulario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[estado]    Script Date: 19/2/2020 16:27:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[estado](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [nvarchar](100) NULL,
	[descripcion] [nvarchar](100) NULL,
 CONSTRAINT [PK_estado] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[formulario]    Script Date: 19/2/2020 16:27:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[formulario](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[motivoSolicitud] [nvarchar](50) NULL,
	[fechaPedido] [datetime] NULL,
	[fechaEjecucion] [datetime] NULL,
	[propietarioDatos] [int] NULL,
	[plataforma] [nvarchar](50) NULL,
	[servicio] [nvarchar](50) NULL,
	[usuario] [int] NULL,
	[instanciaSolicitante] [nvarchar](50) NULL,
	[proteccionArchInformacion] [nvarchar](50) NULL,
	[usuarioNuevo] [int] NULL,
	[responsableAprobacion] [int] NULL,
	[responsableEjecucion] [int] NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_formulario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gerencia]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gerencia](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [nvarchar](50) NULL,
	[delegado] [int] NULL,
	[subDelegado] [int] NULL,
 CONSTRAINT [PK_gerencia] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[logsAccion]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsAccion](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](10) NULL,
	[acccion] [nvarchar](20) NULL,
	[mensaje] [nvarchar](100) NULL,
	[fecha] [smalldatetime] NOT NULL,
 CONSTRAINT [PK_logsAccion] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[logsAcierto]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsAcierto](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](100) NULL,
	[fecha] [datetime] NULL,
	[mensaje] [nvarchar](100) NULL,
 CONSTRAINT [PK_logsAcierto] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[logsConexionBD]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsConexionBD](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](10) NULL,
	[operacion] [nvarchar](50) NULL,
	[mensaje] [nvarchar](100) NULL,
	[fecha] [smalldatetime] NOT NULL,
 CONSTRAINT [PK_logsConexionBD] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[logsError]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsError](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](100) NULL,
	[accion] [nvarchar](20) NULL,
	[mensaje] [nvarchar](100) NULL,
	[fecha] [smalldatetime] NULL,
 CONSTRAINT [PK_logsError] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[permiso]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[permiso](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [nvarchar](50) NULL,
	[nivel] [int] NULL,
	[padre] [int] NULL,
	[link] [nvarchar](100) NULL,
 CONSTRAINT [PK_permiso] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[rol]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rol](
	[id] [nvarchar](50) NOT NULL,
	[nombre] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_rol] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_rol] UNIQUE NONCLUSTERED 
(
	[nombre] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[rol_permiso]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rol_permiso](
	[id_rol] [nvarchar](50) NULL,
	[id_permiso] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[usuario]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuario](
	[id] [int] NOT NULL,
	[legajo] [nvarchar](10) NULL,
	[contraseña] [nvarchar](50) NULL,
	[nombre] [nvarchar](50) NULL,
	[apellido] [nvarchar](50) NULL,
	[cargo] [nchar](10) NULL,
	[gerencia] [nvarchar](50) NULL,
	[contador] [bigint] NULL,
	[firma] [nvarchar](100) NULL,
	[estado] [nvarchar](50) NULL,
	[id_rol] [int] NULL,
 CONSTRAINT [PK_usuario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[usuarioAcceso]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuarioAcceso](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[legajo] [nvarchar](100) NULL,
	[nombre] [nvarchar](100) NULL,
	[perfil] [nvarchar](70) NULL,
	[estado] [nvarchar](50) NULL,
	[aplicativo] [int] NULL,
	[fechaActualizacion] [smalldatetime] NULL,
 CONSTRAINT [PK_usuarioAcceso] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  View [dbo].[vw_usuarioAcceso]    Script Date: 19/2/2020 16:27:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[vw_usuarioAcceso]
as
select ACC.legajo,
	   ACC.nombre nombreUsuario,
	   ACC.perfil,
	   ACC.estado,
	   APP.id,
	   APP.nombre nombreAplicativo,
	   APP.jefeGerencia,
	   APP.propietarioGerencia,
	   APP.nombreBase,
	   ACC.fechaActualizacion 
from [BD_Formulario].[dbo].[usuarioAcceso] ACC
INNER JOIN [BD_Formulario].[dbo].[aplicativo] APP on APP.id = ACC.aplicativo
GO
SET ANSI_PADDING ON

GO
/****** Object:  Index [IX_rol_permiso]    Script Date: 19/2/2020 16:27:35 ******/
CREATE NONCLUSTERED INDEX [IX_rol_permiso] ON [dbo].[rol_permiso]
(
	[id_rol] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[aplicativo]  WITH CHECK ADD  CONSTRAINT [FK_aplicativo_gerencia] FOREIGN KEY([jefeGerencia])
REFERENCES [dbo].[gerencia] ([id])
GO
ALTER TABLE [dbo].[aplicativo] CHECK CONSTRAINT [FK_aplicativo_gerencia]
GO
ALTER TABLE [dbo].[aplicativo]  WITH CHECK ADD  CONSTRAINT [FK_aplicativo_gerencia1] FOREIGN KEY([propietarioGerencia])
REFERENCES [dbo].[gerencia] ([id])
GO
ALTER TABLE [dbo].[aplicativo] CHECK CONSTRAINT [FK_aplicativo_gerencia1]
GO
ALTER TABLE [dbo].[aplicativo_formulario]  WITH CHECK ADD  CONSTRAINT [FK_aplicativo_formulario_aplicativo] FOREIGN KEY([id_aplicativo])
REFERENCES [dbo].[aplicativo] ([id])
GO
ALTER TABLE [dbo].[aplicativo_formulario] CHECK CONSTRAINT [FK_aplicativo_formulario_aplicativo]
GO
ALTER TABLE [dbo].[aplicativo_formulario]  WITH CHECK ADD  CONSTRAINT [FK_aplicativo_formulario_formulario] FOREIGN KEY([id_formulario])
REFERENCES [dbo].[formulario] ([id])
GO
ALTER TABLE [dbo].[aplicativo_formulario] CHECK CONSTRAINT [FK_aplicativo_formulario_formulario]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_estado] FOREIGN KEY([estado])
REFERENCES [dbo].[estado] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_estado]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_usuario] FOREIGN KEY([propietarioDatos])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_usuario]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_usuario1] FOREIGN KEY([responsableAprobacion])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_usuario1]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_usuario2] FOREIGN KEY([responsableEjecucion])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_usuario2]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_usuario3] FOREIGN KEY([usuario])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_usuario3]
GO
ALTER TABLE [dbo].[formulario]  WITH CHECK ADD  CONSTRAINT [FK_formulario_usuarioAcceso] FOREIGN KEY([usuarioNuevo])
REFERENCES [dbo].[usuarioAcceso] ([id])
GO
ALTER TABLE [dbo].[formulario] CHECK CONSTRAINT [FK_formulario_usuarioAcceso]
GO
ALTER TABLE [dbo].[gerencia]  WITH CHECK ADD  CONSTRAINT [FK_gerencia_usuario] FOREIGN KEY([delegado])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[gerencia] CHECK CONSTRAINT [FK_gerencia_usuario]
GO
ALTER TABLE [dbo].[gerencia]  WITH CHECK ADD  CONSTRAINT [FK_gerencia_usuario1] FOREIGN KEY([subDelegado])
REFERENCES [dbo].[usuario] ([id])
GO
ALTER TABLE [dbo].[gerencia] CHECK CONSTRAINT [FK_gerencia_usuario1]
GO
ALTER TABLE [dbo].[logsAccion]  WITH CHECK ADD  CONSTRAINT [FK_logsAccion_logsAccion] FOREIGN KEY([id])
REFERENCES [dbo].[logsAccion] ([id])
GO
ALTER TABLE [dbo].[logsAccion] CHECK CONSTRAINT [FK_logsAccion_logsAccion]
GO
ALTER TABLE [dbo].[rol_permiso]  WITH CHECK ADD  CONSTRAINT [FK_rol_permiso_permiso] FOREIGN KEY([id_permiso])
REFERENCES [dbo].[permiso] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[rol_permiso] CHECK CONSTRAINT [FK_rol_permiso_permiso]
GO
ALTER TABLE [dbo].[rol_permiso]  WITH CHECK ADD  CONSTRAINT [FK_rol_permiso_rol] FOREIGN KEY([id_rol])
REFERENCES [dbo].[rol] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[rol_permiso] CHECK CONSTRAINT [FK_rol_permiso_rol]
GO
USE [master]
GO
ALTER DATABASE [BD_Formulario] SET  READ_WRITE 
GO
