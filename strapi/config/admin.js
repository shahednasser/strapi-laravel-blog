module.exports = ({ env }) => ({
  auth: {
    secret: env('ADMIN_JWT_SECRET', '346a4871e097ec2c27dd932b289e2a53'),
  },
});
