USE [BD_Formulario]
GO
/****** Object:  Table [dbo].[aplicativo]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[aplicativo_formulario]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[estado]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[formulario]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[gerencia]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[logsAccion]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsAccion](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](100) NULL,
	[fecha] [datetime] NULL,
	[mensaje] [nvarchar](100) NULL,
 CONSTRAINT [PK_logsAccion] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[logsAcierto]    Script Date: 27/1/2020 16:18:54 ******/
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
/****** Object:  Table [dbo].[logsError]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logsError](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[usuario] [nvarchar](100) NULL,
	[fecha] [datetime] NULL,
	[mensaje] [nvarchar](100) NULL,
 CONSTRAINT [PK_logsError] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[permiso]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[permiso](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [nvarchar](50) NULL,
 CONSTRAINT [PK_permiso] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[rol]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rol](
	[id] [nvarchar](50) NOT NULL,
	[nombre] [nvarchar](50) NULL,
 CONSTRAINT [PK_rol] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[rol_permiso]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rol_permiso](
	[id_rol] [nvarchar](50) NULL,
	[id_permiso] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[usuario]    Script Date: 27/1/2020 16:18:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuario](
	[id] [int] NOT NULL,
	[legajo] [int] NULL,
	[contraseña] [nvarchar](50) NULL,
	[nombre] [nvarchar](50) NULL,
	[apellido] [nvarchar](50) NULL,
	[cargo] [nchar](10) NULL,
	[gerencia] [nvarchar](50) NULL,
	[contador] [bigint] NULL,
	[firma] [nvarchar](100) NULL,
	[id_rol] [int] NULL,
 CONSTRAINT [PK_usuario] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[usuarioAcceso]    Script Date: 27/1/2020 16:18:54 ******/
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
